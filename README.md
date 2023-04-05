# ITS_PFA 1A (~50% complete)
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
- [x] /issues/{id}
- [ ] /issues/{id}/update _WIP_
- [ ] /issues/{id}/delete _WIP_
- [ ] /issues/{id}/close _WIP_ 
- [ ] /issues/{id}/open _WIP_ 
- [x] /issues/{id}/newComment
- [ ] /issues/{id}/comments/{comment_id}/update 
- [ ] /issues/{id}/comments/{comment_id}/delete 

- [x] /teams 
- [ ] /teams/search
- [x] /teams/create
- [x] /teams/{id}
- [x] /teams/{id}/delete
- [x] /teams/{id}/edit
- [x] /teams/changeTeam

- [ ] /admin/dashboard
- [ ] /admin/profile
- [ ] /admin/...all the issues stuff
- [ ] /admin/users/search 
- [ ] /admin/users/{id}/update 
- [ ] /admin/users/{id}/block
- [ ] /admin/users/{id}/delete 
