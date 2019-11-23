FROM arcticbit/bullet-train-frontend:latest

WORKDIR /frontend

COPY ./docker/bullet-train-frontend/project_dev.js ./env/project_dev.js
COPY ./docker/bullet-train-frontend/project_prod.js ./env/project_prod.js

ENV ENV dev
RUN npm install
#RUN npm run env
#RUN npm run bundle

EXPOSE 8080
#CMD [ "npm", "run", "start" ]
CMD [ "npm", "run", "dev" ]