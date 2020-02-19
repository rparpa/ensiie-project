# base image
FROM node:12.2.0-alpine

# set working directory
WORKDIR /app

ENV PATH /app/node_modules/.bin:$PATH

COPY . /app/

RUN npm install @vue/cli@3.7.0 -g

EXPOSE 8080

VOLUME /app/

CMD ["npm", "run", "serve"]