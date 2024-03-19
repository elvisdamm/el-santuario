#!/bin/bash
# auditoría de red segura según guía del CIS
# genera resultado por consola
# necesario ejecutar como root

SEPARADOR="------------------------------------------"

if [ $USER = "root" ]
then
	
	echo CIS 3.3.2
	echo Deshabilitar mensajes ICMP redirect para evitar cambios en tabla de enrutamiento
	echo Esperado: net.ipv4.conf.all.accept_redirects = 0
	echo Esperado: net.ipv4.conf.default.accept_redirects = 0
	cat /etc/sysctl.conf | grep accept_redirects
	echo $SEPARADOR
	
	echo CIS 3.2.2
	echo Deshabilitar IP Forwarding para evitar realizar funciones de enrutamiento
	echo Esperado: net.ipv4.ip_forward = 0
	cat /etc/sysctl.conf | grep ip_forward
	echo $SEPARADOR
	
	echo CIS 3.3.5
	echo Deshabilitar respuestas ICMP broadcast para evitar ataques smurf DDoS
	echo Esperado: net.ipv4.icmp_echo_ignore_broadcasts = 1
	cat /etc/sysctl.conf | grep icmp_echo_ignore_broadcasts
	echo $SEPARADOR

	echo CIS 3.3.6
	echo Rechazar paquetes ICMP bogus para evitar su registro y saturación de logs 
	echo Esperado: net.ipv4.icmp_ignore_bogus_error_responses = 1
	cat /etc/sysctl.conf | grep icmp_ignore_bogus_error_responses
	echo $SEPARADOR

	echo CIS 3.3.7
	echo Habilitar Reverse path filtering
	echo Esperado: net.ipv4.conf.all.rp_filter = 1
	echo Esperado: net.ipv4.conf.default.rp_filter = 1
	cat /etc/sysctl.conf | grep rp_filter
	echo $SEPARADOR

	echo CIS 3.3.8
	echo Habilitar TCP SYN Cookies para evitar ataques SYN FLOOD
	echo Esperado: net.ipv4.tcp_syncookies = 1 
	cat /etc/sysctl.conf | grep tcp_syncookies
	echo $SEPARADOR

	echo CIS 3.4
	protocolos="dccp sctp rds tipc"
	for PROTOCOLO in $protocolos
		do
			echo Deshabilitar protocolo $PROTOCOLO	
			echo Esperado: install $PROTOCOLO /bin/true
			cat /etc/modprobe.d/${PROTOCOLO}.conf | grep install
			echo $SEPARADOR
		done
	
	
else
        echo "Necesario ejecutar con permisos de root"
fi