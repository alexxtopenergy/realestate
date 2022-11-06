#ToDo Write normal and clear Documentation

You can automatically deploy a local docker WordPress site using the following commands:

# Build and start installation
docker-compose up -d

#Visit your site at 
http://localhost

# Stop and remove containers
docker-compose down

# Reset everything
docker-compose down
rm -rf certs/* certs-data/* logs/nginx/* mysql/* wordpress/*

# Activate My Estate plugin
http://localhost/wp-admin/plugins.php

# Filter Shortcode, 1 - enable
[my_estate_list materials="1" rooms="1"]
 
# Just in case update permalinks
http://localhost/wp-admin/options-permalink.php

# Real Estate Catalog
http://localhost/properties/

# Shortcode Page 
http://localhost/shortcode/

#import Demo Data 
http://localhost/wp-admin/import.php

Please, import realestate.WordPress.2022-11-06.xml in root path



