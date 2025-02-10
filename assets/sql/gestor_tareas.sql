CREATE DATABASE gestor_tareas;

USE gestor_tareas;

CREATE TABLE
  `usuarios` (
    `usuario` varchar(50) NOT NULL,
    `password` varchar(200) NOT NULL,
    `id` int primary key AUTO_INCREMENT
  );

CREATE TABLE
  `tarea` (
    `id` int primary key AUTO_INCREMENT,
    `titulo` varchar(20) NOT NULL,
    `descripcion` varchar(200)
  );

CREATE TABLE
  `usuarios_tarea` (
    `id` int PRIMARY key AUTO_INCREMENT,
    `tarea` int,
    `usuario` int,
    FOREIGN KEY (usuario) REFERENCES usuarios (id) ON DELETE CASCADE,
    FOREIGN KEY (tarea) REFERENCES tarea (id) ON DELETE CASCADE
  );

/* modificaciones:
añadimos los on delete cascade en la tabla intermedia
y añadimos un campo status a la tarea */