
CREATE TABLE USERS(

    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(25) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL, 
    date TIMESTAMP NOT NULL
    
);

CREATE TABLE ARTICLES(

    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    article TEXT NOT NULL,
    user_id int(11) NOT NULL,
    date TIMESTAMP NOT NULL,
    FOREIGN KEY(user_id) REFERENCES users(id)
    
);






















