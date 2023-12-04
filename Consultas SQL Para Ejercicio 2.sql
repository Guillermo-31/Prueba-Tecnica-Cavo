USE Practica_Pasantia_Cavo
GO

CREATE TABLE Roles (
	Codigo INT PRIMARY KEY IDENTITY(1,1),
	Nombre VARCHAR(100),
	Descripcion TEXT
);
GO

CREATE TABLE Usuarios (
	Codigo INT PRIMARY KEY IDENTITY(1,1),
	Nombre VARCHAR(50),
	Apellido VARCHAR(50),
	Rol INT,
	FOREIGN KEY (Rol) REFERENCES Roles(Codigo)
);
GO

INSERT INTO Roles (Nombre, Descripcion) VALUES ('Administrador', 'Usuario con todos los privilegios disponibles del sistema'), ('Empleado', 'Usuario con privilegios limitados');
GO

INSERT INTO Usuarios (Nombre, Apellido, Rol) VALUES ('Jaime', 'Villatoro', 1), ('Fátima', 'Hernández', 2), ('Belén', 'Andasol', 1), ('Eduardo', 'Martínez', 2);
GO

SELECT * FROM Roles
GO

SELECT * FROM Usuarios
GO

SELECT * FROM Usuarios WHERE Rol = 1; -- Seleccionar Usuarios que contengan el rol de administrador, según el código del rol.
GO

SELECT Usuarios.Codigo, Usuarios.Nombre, Usuarios.Apellido, Roles.Nombre AS 'Rol' FROM Usuarios INNER JOIN Roles ON Usuarios.Rol = Roles.Codigo WHERE Roles.Nombre = 'Administrador'; -- Obtener Usuarios que contengan el rol de administrador según el nombre del rol.
GO