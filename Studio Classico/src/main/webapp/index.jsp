<jsp:useBean id="userBean" scope="session" class="es.uco.iw.model.CustomerBean"></jsp:useBean>

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
	<a href="loginServlet">Iniciar sesión</a>
	<a href="registerServlet">Registro</a>
<%
	} else {
%>
	<a href="logoutServlet">Cerrar sesión</a>
<% 
	}
%>

Rankings

Popularidad
Duración
Antiguedad
<a href="addPieceServlet">Cerrar sesión</a>
</body>
</html>