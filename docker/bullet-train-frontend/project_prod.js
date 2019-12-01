module.exports = global.Project = {
    debug: true,
    env: 'prod', // This is used for Sentry tracking
    bulletTrain: '4vfqhypYjcPoGGu8ByrBaj', // This is our Bullet Train API key - Bullet Train runs on Bullet Train!
    api: 'http://localhost:8081/api/v1/',
    ga: 'UA-120237963-1', // This is our Google Analytics key
    sentry: 'https://11c8828dc24041b0a875e324b0380769@sentry.io/1320942',
    demoAccount: {
        email: 'kyle+bullet-train@solidstategroup.com',
        password: 'demo_account',
    },
    chargebee: {
        site: 'bullettrain',
    },
    mixpanel: '9448f5be8a5555c380e5dd4b7ac2c345',
    youtubeApi: 'AIzaSyCAjMzgz8vbxqReBxkQGcwsda6zAO0L2JE',
    assetUrl: 'https://cdn.bullet-train.io', // Location of the static files from build/, should contain a directory called static/
};