# ITS_PFA
End of Year Project (Issue Tracking System)

## Running
```sh
php artisan migrate:fresh
php artisan db:seed
npm run dev
```

## To install ui auth (Deja msayb don't run it)

```sh
composer require laravel/ui 
php artisan ui bootstrap --auth 
```
## DB
- Users(
  id INT,
  email VARCHAR(255),
  name VARCHAR(255),
  password VARCHAR(255),
  team_id FK teams.id, 
  role ENUM('admin', 'team_admin', 'member', 'guest')
)

- Teams(
  id INT,
  name VARCHAR(255),
)

- Issues(
  id,
  title VARCHAR(255),
  status ENUM('Open', 'Closed'),
  severity INT,
  team_id FK teams.id,
  owner_id FK users.id,
  assignee_id FK users.id
)

- Comments(
  issue_id INT,
  owner FK users.id,
  comment TEXT,
)

## Routes:

- [x] /login
- [x] /register
- [x] /dashboard 
- [ ] /profile

- [x] /issues
- [ ] /issues/search
- [x] /issues/create
- [x] /issues/my
- [ ] /issues/{id}
- [ ] /issues/{id}/update 
- [ ] /issues/{id}/delete 
- [ ] /issues/{id}/close 
- [ ] /issues/{id}/open 
- [ ] /issues/{id}/close 
- [ ] /issues/{id}/comments
- [ ] /issues/{id}/comments/new 
- [ ] /issues/{id}/comments/{comment_id}/update 
- [ ] /issues/{id}/comments/{comment_id}/delete 

- [ ] /teams/search 
- [ ] /teams/{id}
- [ ] /teams/{id}/join 

- [ ] /admin/dashboard
- [ ] /admin/profile
- [ ] /admin/...all the issues stuff
- [ ] /admin/users/search 
- [ ] /admin/users/{id}/update 
- [ ] /admin/users/{id}/block
- [ ] /admin/users/{id}/delete 

- [ ] /admin/teams/create 
- [ ] /admin/teams/{id}/update 
- [ ] /admin/teams/{id}/delete 
- [ ] /admin/users/{id}/addToTeam

