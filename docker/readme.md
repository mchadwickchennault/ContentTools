# Docker Setup for Content Tools
To start the environment, cd into the `docker` directory and run `docker-compose up -d --build`

## Database Setup
The first time you run the enviroment you will need to complete a few setup tasks
* Using your favorite MySQL editor, log into `localhost` (user: root password: pass) and create the following databases (schema):
  1. `ResourceSpace`
  2. `CWDB_BizInt`
  3. `CWDB_CourseData`