SET foreign_key_checks = 0;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS permissions;
DROP TABLE IF EXISTS role_permissions;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    encrypted_password VARCHAR(255) NOT NULL,
    role_id INT,
        CONSTRAINT fk_users_role_id
            FOREIGN KEY (role_id) REFERENCES roles(id)
            ON DELETE SET NULL
);

CREATE TABLE roles(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE permissions(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE role_permissions(
    role_id INT NOT NULL,
    permission_id INT NOT NULL,

    --Chave primaria composta para garantir unicidade--
    PRIMARY KEY (role_id, permission_id),

    CONSTRAINT fk_role_permissions_role_id 
        FOREIGN KEY (role_id) REFERENCES roles(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_role_permissions_permission_id 
        FOREIGN KEY (permission_id) REFERENCES permissions(id)
        ON DELETE CASCADE
);


SET foreign_key_checks = 1;
