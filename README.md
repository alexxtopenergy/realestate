You can automatically deploy a local docker WordPress site using the following commands:

# Build and start installation
docker-compose up -d --build

#Visit your site at http://localhost

# Stop and remove containers
docker-compose down
# Build, and start the WordPress website
docker-compose up -d --build
# Reset everything
docker-compose down
rm -rf certs/* certs-data/* logs/nginx/* mysql/* wordpress/*


# Filter Shortcode, 1 - enable
[my_estate_list materials="1" rooms="1"]
 
# Activate My Estate plugin 
http://localhost/wp-admin/plugins.php

# Just in case update permalinks
http://localhost/wp-admin/options-permalink.php

# Real Estate Catalog
http://localhost/properties/

# Shortcode Page http://localhost/shortcode/

#import Demo Data 


