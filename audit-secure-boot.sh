#!/bin/bash
# auditoría sobre arranque seguro
# basado en guía de bastionado CIS para Ubuntu Linux 18.04 LTS
# genera resultado por consola
# necesario ejecutar como root

if [ $USER = "root" ]
then

	# comprobar propietarios y permisos de grub.cfg
	echo
	echo Propietarios y permisos de /boot/grub/grub.cfg
	echo Esperado: 400 o 600,  uid 0 gid 0
	stat /boot/grub/grub.cfg
	echo
	
	# comprobar opción unrestricted para arrancar sin contraseña
	echo
	echo Opción unrestricted en /etc/grub.d/10_linux
	echo Esperado: CLASS="--class gnu-linux --class gnu --class os --unrestricted"
	cat /etc/grub.d/10_linux | grep unrestricted
	echo

	# script de configuración de contraseña de arranque
	echo
	echo permisos de /etc/grub.d/init-pwd
	echo Esperado: ejecución x
	ls -l /etc/grub.d/init-pwd
	echo
	echo contenido de /etc/grub.d/init-pwd
	echo Esperado: varios - cat set password_pbkdf2 ...
	cat /etc/grub.d/init-pwd
	echo
else
        echo "Necesario ejecutar con permisos de root"
fi