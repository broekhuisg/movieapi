FROM node:lts-alpine as build-stage

# make the 'app' folder the current working directory
WORKDIR /app

COPY package*.json ./

# install project dependencies
COPY . .
RUN npm install
RUN npm run build

EXPOSE 3000
CMD ["npm", "start"]

# copy project files and folders to the current working directory (i.e. 'app' folder)
#FROM build-stage as dev-stage
#
#EXPOSE 8080
#CMD ["npm", "run", "serve"]

## production stage
#FROM nginx:stable-alpine as production-stage
#COPY --from=build-stage /app/dist /usr/share/nginx/html
#COPY nginx/default.conf /etc/nginx/conf.d/default.conf
#
#EXPOSE 80
#CMD ["nginx", "-g", "daemon off;"]
