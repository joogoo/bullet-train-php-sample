FROM arcticbit/bullet-train-frontend:latest

WORKDIR /frontend

COPY ./docker/bullet-train-frontend/project_dev.js ./env/project_dev.js

EXPOSE 8080

CMD [ "npm", "run", "dev" ]