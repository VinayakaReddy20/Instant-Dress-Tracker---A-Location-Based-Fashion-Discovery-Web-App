-- Create the shopownersignup table
CREATE TABLE shopownersignup (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    shop_id INT UNIQUE NOT NULL,        
    email VARCHAR(255) UNIQUE NOT NULL, 
    password VARCHAR(255) NOT NULL,     
    shopName VARCHAR(255) NOT NULL,     
    shopAddress VARCHAR(255) NOT NULL,  
    shopContactNumber VARCHAR(15) NOT NULL, 
    operatingHours VARCHAR(255) NOT NULL,  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Create the shopownerlogin table
CREATE TABLE shopownerlogin (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    shop_id INT NOT NULL,              
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,    
    FOREIGN KEY (shop_id) REFERENCES shopownersignup(shop_id) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Create the stock table
CREATE TABLE Stock (
    id INT AUTO_INCREMENT PRIMARY KEY,   
    shop_id INT NOT NULL,                 
    photo LONGBLOB NOT NULL,              
    name VARCHAR(255) NOT NULL,           
    description TEXT,                     
    sizes VARCHAR(255),                   
    colors VARCHAR(255),                  
    price DECIMAL(10, 2) NOT NULL,        
    quantity INT NOT NULL,               
    FOREIGN KEY (shop_id) REFERENCES shopownersignup(shop_id) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
