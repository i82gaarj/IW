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
	<a href="loginServlet">Iniciar sesi�n</a>
	<a href="registerServlet">Registro</a>
<%
	} else {
%>
	<a href="logoutServlet">Cerrar sesi�n</a>
<% 
	}
%>

Rankings

Popularidad
Duraci�n
Antiguedad
<a href="addPieceServlet">A�adir obra</a>
</body>
</html>