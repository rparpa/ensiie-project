FROM node:12

WORKDIR /app

COPY ["package.json", "package-lock.json*", "./"]
#COPY package.json .

#RUN npm install --production --silent && mv node_modules ../
RUN npm install

COPY . ./

EXPOSE 3000

#RUN npm install -g nodemon

CMD npm start
