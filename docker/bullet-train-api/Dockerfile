FROM arcticbit/bullet-train-api:latest

WORKDIR /api

COPY ./docker/bullet-train-api/views.py ./src/organisations/views.py

RUN pip install pipenv
RUN pipenv install --deploy

ENV DJANGO_SETTINGS_MODULE=app.settings.master-docker
EXPOSE 8000