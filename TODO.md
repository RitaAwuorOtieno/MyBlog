# TODO: Testing Checklist and API Tests for MyBlog

## Frontend Thorough Testing Checklist

- [ ] Visit and navigate the Home, About, Contact pages.
- [ ] Browse blog listing and verify blog post display.
- [ ] Open individual blog posts and check content, comments, navigation.
- [ ] Test user authentication flows:
  - [ ] Registration page: submit valid and invalid inputs.
  - [ ] Login page: login with valid and invalid credentials.
  - [ ] Password reset flow: request link, reset password.
  - [ ] Email verification page and verification process.
- [ ] Profile page testing:
  - [ ] Edit profile information and submit.
  - [ ] Change password with valid and invalid current password.
  - [ ] Delete account flow.
- [ ] Admin panel:
  - [ ] Access dashboard.
  - [ ] Create, edit, delete blog posts.
  - [ ] Manage users if available.
- [ ] Validate all forms have proper validation errors on bad input.
- [ ] Check all links, buttons, and interactive UI elements for expected behavior.
- [ ] Verify navigation menus, responsiveness, and layout correctness.

## Backend API Endpoint and Edge Case Testing

You can run the following curl commands on the terminal to test the APIs:

### Authentication

- Login (replace with actual email/password):
```bash
curl -X POST http://127.0.0.1:8000/api/login -d "email=user@example.com&password=secret"
```

- Logout:
```bash
curl -X POST http://127.0.0.1:8000/api/logout -H "Authorization: Bearer <token>"
```

### Blog Posts

- List posts:
```bash
curl http://127.0.0.1:8000/api/posts
```

- Get a post by ID:
```bash
curl http://127.0.0.1:8000/api/posts/{id}
```

- Create a post (requires auth token):
```bash
curl -X POST http://127.0.0.1:8000/api/posts -H "Authorization: Bearer <token>" -d "title=New Post&content=Post content"
```

- Update a post:
```bash
curl -X PUT http://127.0.0.1:8000/api/posts/{id} -H "Authorization: Bearer <token>" -d "title=Updated Title&content=Updated content"
```

- Delete a post:
```bash
curl -X DELETE http://127.0.0.1:8000/api/posts/{id} -H "Authorization: Bearer <token>"
```

### Payments

- List payments:
```bash
curl http://127.0.0.1:8000/api/payments
```

- Create a payment (requires auth):
```bash
curl -X POST http://127.0.0.1:8000/api/payments -H "Authorization: Bearer <token>" -d "amount=100&method=mpesa"
```

### User Profile

- Update profile info:
```bash
curl -X PUT http://127.0.0.1:8000/api/profile -H "Authorization: Bearer <token>" -d "name=New Name&email=test@example.com"
```

- Delete user account:
```bash
curl -X DELETE http://127.0.0.1:8000/api/profile -H "Authorization: Bearer <token>"
```

---

### Edge Case Tests

- Use invalid or expired tokens in protected endpoints and verify 401 Unauthorized.
- Submit invalid or incomplete data to API endpoints and verify proper validation error responses.
- Test rate limits or security restrictions if applicable.

---

Please execute these frontend manual tests and backend API commands step-by-step and share any issues or errors you encounter for further assistance.
