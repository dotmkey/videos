<p align="center">
    <h1 align="center">Videos Test Project</h1>
    <br>
</p>

To enjoy videos run the next commands from the root directory:
1. ```docker-compose up -d --force-recreate```
2. ```docker exec -ti videos_php composer install```
3. ```docker exec -ti videos_php php yii migrate```
4. ```docker exec -ti videos_php php yii fill-db```
5. ```sudo chmod o+w ./web/assets/``` - workaround that definitely must be resolved in other way

and click [here](http://127.0.0.1:8080/video)

P.S. You should stop all the running docker containers before executing the commands above to prevent possible port conflicts.

P.P.S. The fourth command takes >=2 minutes depending on computer power.

P.P....S. Sometimes the first couple of queries are executed pretty long. Just be aware, it's not forever.