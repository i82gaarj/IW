<jsp:useBean id="userBean" scope="session" class="es.uco.iw.model.UserBean"></jsp:useBean>
<jsp:useBean id="pieceBean" scope="session" class="es.uco.iw.model.PieceBean"></jsp:useBean>

<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%
	if (userBean.getEmail() == null){
		response.sendRedirect(request.getContextPath() + "/errorPage.jsp");
	}
%>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<%= request.getContextPath() %>/css/style.css">
    <title>Ver obra</title>
</head>
<body>
	<div class="cuadro">
		<div class="container-center">
		    <div class="header">
				<h1 class="page-title">Ver obra</h1>
				<p class="subtitle">Rellene el formulario</p>
		    </div>
		    <div class="view-piece">
		        <span>Título: <%  %></span>
		    </div>
		</div>
	</div>
</body>
</html>