Product
=======================

Introduction
------------
- The application was created from scratch and follows design patterns like:
    - MVC.
    - FrontController.
    - Domain-driven design (DDD).
    - Dependency Injection (DI).
- It follows Solid principles.
- Code has been covered by PHPunit (not working cause PHPunit old version).
- PHP:7.0
- mysql:5.6

Installation
------------
- Copy .env_eample to .env file `cp .env_exmple .env`.
- Run `docker compose up`.
- Open in the browser `http://localhost/product/all`.

How does it work?
------------------ 
- Working directory: `php`.
- Create Controller class in Controller directory and name should follow this pattern `{ClassName}Controller.php`.
- Add method actions in the class and the name should follow `{methodName}Action`.
- Initialize the class in Bootstrap file and should name follow this pattern `New{ClassName}Controller.php` and here where you can identify all DI the would be passed to the controller if it's required.
- Finally Add new route in `config\routes.php` so the created action could be called from postman.

Security
---------
- To make this backend be consumed by Frontend app [Frontend app](https://github.com/yakob-abada/scandiweb-app)
- index.php line 3 needed to be updated with frontend domain url to strict CORS.

What to improve
---------------
- Introduce structured logs for better debugging.
- Increase code testing coverage.
- Add to pipeline auto deployment to AWS EC2 fargate.
- This works on PHP7.0 which requires to use old phpunit that's faulty and is not supported anymore.