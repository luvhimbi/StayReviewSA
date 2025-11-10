User Features

User Registration/Login

Email/password signup

Social login (optional)

Email verification

Profile Management

Edit personal info

Upload avatar

Track user reviews

Apartment/Property Ratings

Rate apartments on various criteria (cleanliness, amenities, location, price)

Leave detailed reviews/comments

Add photos of the apartment

Search & Filter

Search by location, price range, property type

Filter by rating, availability, amenities

Favorites / Wishlist

Save favorite apartments for later

Messaging / Contact

Contact property owners or managers

Optional chat for inquiries

Notifications

Alerts for new apartments in preferred areas

Updates on replied messages

POPI / Privacy Consent

Consent for storing personal info and reviews




2. Admin / Property Owner Features

Property Management

Add new properties

Edit property details (photos, description, pricing)

Manage availability status

Review Management

Moderate user reviews

Flag or delete inappropriate reviews

Dashboard & Analytics

See most rated properties

Track user activity

Summary of average ratings

User Management

Manage users (ban, edit roles, etc.)



3. Social / Community Features

Top Rated / Featured Apartments

Show highly rated apartments

Review Voting

Users can mark reviews as helpful

Comment Replies

Owners can reply to reviews

Share Properties

Share links to social media

4. Optional Advanced Features

Map Integration

View properties on Google Maps or OpenStreetMap

Nearby Amenities

Show nearby schools, supermarkets, transport links

Booking / Appointment Scheduling

Schedule viewing or virtual tours

Analytics for Users

Track how many people viewed your reviews



CREATE TABLE reviews (
id BIGSERIAL PRIMARY KEY,
user_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
property_id BIGINT NOT NULL REFERENCES properties(id) ON DELETE CASCADE,
review TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE favorites (
id BIGSERIAL PRIMARY KEY,
user_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
property_id BIGINT NOT NULL REFERENCES properties(id) ON DELETE CASCADE,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE messages (
id BIGSERIAL PRIMARY KEY,
sender_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
receiver_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
property_id BIGINT REFERENCES properties(id) ON DELETE SET NULL,
message TEXT NOT NULL,
read_status BOOLEAN DEFAULT FALSE,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

