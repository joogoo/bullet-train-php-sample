Bullet Train PHP sample
================================================================

An example of a project to take as a proof of concept that helps to integrate the [Bullet Train API](https://github.com/SolidStateGroup/bullet-train-api) with PHP.

This project does not aim to cover best practices for PHP project development as a whole. For example, it does not provide an exhaustive documentation, or unit tests.

However, it provides a good foundation for integrating your developments under the continuous deployment approach, including the implementation of feature flags via [Bullet Train](https://bullet-train.io).

## Getting started

You'll need [docker](https://www.docker.com/) and [docker-compose](https://docs.docker.com/compose/).

To work properly, Bullet Train requires a Google Analytics account. For testing purposes, I abandoned this feature by injecting a workaround into the API.

Do not use this in production !

#### Clone this project

```bash
git clone https://github.com/joogoo/bullet-train-php-sample.git;
```

#### Install vendor libraries
```bash
cd bullet-train-php-sample;

docker run --rm --interactive --tty \
  --volume $PWD:/app \
  composer install
```

#### Run the sample services
```bash
docker-compose up -d
```

#### Create a super admin account
```bash
docker exec -it bullet-train-php-sample_api_1 pipenv run python src/manage.py createsuperuser
```

#### Configure your feature flags

- Go to [http://localhost:8082/](http://localhost:8082/) and sign in with the super admin account you created previously.

- Create an organization, a project and finally 2 feature flags:

|    ID   |   Description   |    Enabled  |
|---------|-----------------|-------------|
|  login  |  Login feature  | your choice |
| nice_ui | Nice UI feature | your choice |

- Get the environment key for this project (see the `environmentID` value in the `Code example: 2: Initialising your project` section) and save it as your API_KEY in a conf/client.local.php

- Go back to [http://localhost:8080/](http://localhost:8080) and enjoy switching features in [Bullet Train [http://localhost:8082]](http://localhost:8082/).

## Go further

Three fake accounts are available for testing purposes, so you can go further activating features for some users only with Segments and User Traits.

| Login | Password |
|-------|----------|
| callisto | fake1 |
| ganymede | fake2 |
| europa   | fake3 |
