You can automatically deploy a local docker wordpress site using the following commands:

# Build and start installation
docker-compose up -d --build

#Visit your site at <http://localhost>

# Stop and remove containers
docker-compose down
# Build, and start the wordpress website
docker-compose up -d --build
# Reset everything
docker-compose down
rm -rf certs/* certs-data/* logs/nginx/* mysql/* wordpress/*

