# ITS_PFA 1A (MVP ~70% complete)
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
  description TEXT,
)

- Issues(
  id,
  title VARCHAR(255),
  description TEXT,
  status ENUM('Open', 'Closed'),
  severity INT,
  opened_at DATE,
  closed_at DATE,
  team_id FK teams.id,
  owner_id FK users.id,
  assignee_id FK users.id,
)

- Comments(
  id,
  issue_id INT,
  owner FK users.id,
  comment TEXT,
)

- Attachements(
  id,
  path VARCHAR(255),
  issue_id FK issues.id,
  comment_id FK comments.id,
)

## Routes:

- [x] /login
- [ ] /dashboard 
- [x] /profile

- [x] /issues
- [ ] /issues/search
- [x] /issues/create
- [x] /issues/my
- [x] /issues/assigned 
- [x] /issues/{id}
- [x] /issues/{id}/edit 
- [x] /issues/{id}/close 
- [x] /issues/{id}/newComment

- [x] /comments/{id}/edit 
- [x] /comments/{id}/delete 

- [x] /teams 
- [ ] /teams/search
- [x] /teams/create
- [x] /teams/{id}
- [x] /teams/{id}/delete
- [x] /teams/{id}/edit
- [x] /teams/changeTeam

- [x] /users
- [x] /users/create 
- [x] /users/{id}/resetPassword
- [x] /users/{id}/updateInfo
- [x] /users/{id}/updatePassword
