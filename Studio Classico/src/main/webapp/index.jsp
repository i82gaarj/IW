<jsp:useBean id="userBean" scope="session" class="es.uco.iw.model.UserBean"></jsp:useBean>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Insert title here</title>
</head>
<body>
<%
	if (userBean.getEmail() == null){
%>
	<a href="login">Iniciar sesión</a>
	<a href="register">Registro</a>
<%
	} else {
%>
	<a href="logout">Cerrar sesión</a>
<% 
	}
%>

Rankings

Popularidad
Duración
Antiguedad
<a href="addPiece">Añadir obra</a>
</body>
</html>