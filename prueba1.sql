

ALTER TABLE `elegiractividad` ADD CONSTRAINT `cliente_fk1` FOREIGN KEY (`dniVoluntario`) REFERENCES `usuarios`(`dni`) ;