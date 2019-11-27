- Clone the project 

```bash
# Clone the project
git clone https://github.com/joogoo/bullet-train-php-sample.git;

# Modify your /etc/hosts
echo "php-docker.local  127.0.0.1" >> /etc/hosts

# Change dir
cd bullet-train-php-sample;

# Start the stack
docker-compose up;

# Create a super admin account

docker exec -it bullet-train-php-sample_api_1 pipenv run python src/manage.py createsuperuser
```

- Open the front-end at [http://localhost:8082](http://localhost:8082)

- Create an organization, a project and finally 2 feature flags called:
    - 'login'
    - 'nice_ui'
    

- Copy conf/client.local.dist.php to conf/client.local.php
- Get the environment key for this project and save it as your API_KEY in a conf/client.local.php

- Go back to [php-docker.local:8080](http://php-docker.local:8080) and enjoy switching features in Bullet Train.