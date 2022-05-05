<p align="center">
    <h1 align="center">Videos Test Project</h1>
    <br>
</p>

To enjoy videos run the next commands from the root directory:
1. ```docker-compose up -d --force-recreate```
2. ```docker exec -ti videos_php php yii migrate```
3. ```docker exec -ti videos_php php yii fill-db```

and click [here](http://127.0.0.1/video)

P.S. You should stop all the running docker containers before executing the commands above to prevent possible port conflicts.

P.P.S. The third command takes >=2 minutes depending on computer power.