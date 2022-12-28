<p align="center"><img src="https://upload.wikimedia.org/wikipedia/commons/8/88/Mini-Robot.png" width="200"></p>


## About [BOT NAME]

[BOT NAME] has arrived to The Island to free you of the same stuff over and over.
Do you need your server at your own rules and creativity freedom? Now you can!
Our bot is extensible and easy to develop new plugins to work in your server!
New commands? New drone movements? New player control? You can do it all!

- Complete game logs data mining.
- Easy server management outside the game boundaries.
- Perfect control over all the server rules and discord.
- Extensible bot framework. Yes, you can develop your own plugins to run in your server!
- Automatically validate suspicious player's action.


## For devs

Our documentation is in WIP.

## Installation
1. Clone
    ```cmd
    > git clone https://github.com/victorhramos-dev/scumbot.git bot
    > cd bot
    > composer install
    ```

2. Configure the environment
    ### Windows users
    ```cmd
    > copy .env.example .env
    ```
    ### Unix based
    ```cmd
    > cp .env.example .env
    ```

3. Edit your env file
    ```
    DB_CONNECTION=mysql
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    STEAM_API_KEY=
    FTP_GAMESERVER_HOSTNAME=
    FTP_GAMESERVER_PORT=
    FTP_GAMESERVER_USERNAME=
    FTP_GAMESERVER_PASS=
    ```

4. Create database tables
    ```cmd
    > php artisan migrate:fresh --seed
    ```
## Reset all data
```cmd
> php artisan data:reset
> php artisan data:mine
```
