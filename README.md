# Single sign-on with Laravel and FusionAuth
Sample application from the "Single sign-on with Laravel and FusionAuth" article

## Prerequisites
You will need the following things properly installed on your computer.

## Installation
1. Clone this repository
    ```shell
    $ git clone git@github.com:FusionAuth/fusionauth-example-laravel-single-sign-on.git
    ```
2. Copy `.env.example` to `.env` and change the FusionAuth values there (they're in the end of the file):
    ```env
    # Paste both client Id and secret for your application
    FUSIONAUTH_CLIENT_ID=<APP CLIENT ID FROM FUSIONAUTH>
    FUSIONAUTH_CLIENT_SECRET=<APP CLIENT SECRET FROM FUSIONAUTH>
    
    # Specify a tenant Id or leave this blank for the default tenant
    FUSIONAUTH_TENANT_ID=<ID FOR YOUR TENANT>
    
    # Replace http://localhost:9011 with the address where the FusionAuth application is running
    FUSIONAUTH_BASE_URL=http://localhost:9011
    
    # Replace http://localhost with the address for your PHP application, if necessary
    # We'll create the route for `/auth/callback` later##
    FUSIONAUTH_REDIRECT_URI=http://localhost/auth/callback
    ```
3. Generate a new application key
    ````shell
    $ ./vendor/bin/sail artisan key:generate --ansi
    ```
4. Start Laravel application
    ```shell
    $ ./vendor/bin/sail up -d
    ```

## FusionAuth Configuration
This example assumes that you will run FusionAuth from a Docker container. Run the commands below in a new folder to download the necessary `docker-compose.yml` and `.env` files to spin up a new FusionAuth instance.

```shell
$ cd fusionauth
$ ./install
$ docker compose up -d
```

The FusionAuth configuration files also make use of a unique feature of FusionAuth, called Kickstart: when FusionAuth comes up for the first time, it will look at the [Kickstart file](./fusionauth/kickstart/kickstart.json) and mimic API calls to configure FusionAuth for use. It will perform all the necessary setup to make this demo work correctly, but if you are curious as to what the setup would look like by hand, the "FusionAuth configuration (by hand)" section of this README describes it in detail.

Browse to [localhost:9011](http://localhost:9011/) to verify it is up and running.

> **NOTE**: If you ever want to reset the FusionAuth system, delete the volumes created by docker compose by executing `docker compose down -v` inside the `fusionauth` folder. FusionAuth will only apply the Kickstart settings when it is first run (e.g., it has no data configured for it yet).

## Running / Development

* Start services
    ```shell
    $ ./vendor/bin/sail up -d
    ```
* Navigate to [http://localhost](http://localhost) and click the "Log in" link in the upper right corner of that page to be taken to FusionAuth's login screen.
* After filling and submiting the form, you should be redirected back to the "Welcome" page but instead of seeing the same "Log in" link, you should now see both "Home" and your name there!

You can also register a new user for this application and will be automatically logged in after.

Log into the [FusionAuth admin screen](http://localhost:9011) with a different browser or incognito window using the admin user credentials ("admin@example.com"/"password") to explore the admin user experience.

