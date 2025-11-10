<?php
namespace App\Http\Controllers;


use App\Models\Property;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->input('query');

        // Fetch properties with pagination
        $properties = Property::with(['images', 'reviews'])
            ->when($query, function ($q) use ($query) {
                $q->where('property_name', 'like', "%{$query}%")
                    ->orWhere('address', 'like', "%{$query}%")
                    ->orWhere('city', 'like', "%{$query}%")
                    ->orWhere('property_type', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString()
            ->through(function ($property) {
                $property->averageRating = $property->reviews->avg('overall_rating') ?? 0;
                $property->reviewCount = $property->reviews->count();
                return $property;
            });

        return view('user.dashboard', compact('properties', 'query'));
    }


    public function adminDashboard()
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return redirect()->route('logout')->with('error', 'Unauthorized access.');
        }

        // Fetch counts
        $userCount = User::count();
        $propertyCount = Property::count();
        $reviewCount = Review::count();

        return view('admin.dashboard', compact('user', 'userCount', 'propertyCount', 'reviewCount'));

    }
}
