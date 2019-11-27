FROM arcticbit/bullet-train-frontend:latest

WORKDIR /frontend

COPY ./docker/bullet-train-frontend/project_dev.js ./env/project_dev.js

ENV ENV dev
RUN npm install

EXPOSE 8080
CMD [ "npm", "run", "dev" ]