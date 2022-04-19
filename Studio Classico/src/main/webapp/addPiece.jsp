<jsp:useBean id="userBean" scope="session" class="es.uco.iw.model.UserBean"></jsp:useBean>
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
    <title>Nueva obra</title>
</head>
<body>
	<div class="cuadro">
		<div class="container-center">
		    <div class="header">
				<h1 class="page-title">Nueva obra</h1>
				<p class="subtitle">Rellene el formulario</p>
		    </div>
		    <div class="form-register">
		        <form action="<%= request.getContextPath() %>/addPieceServlet" method="POST">
		            <label for="title">Título:</label>
		            <input type="text" class="input-form" id="title" name="title">
		            <br/>
		            
		            <label for="year">Año:</label>
		            <input type="number" class="input-form" id="year" name="year">
		            <br/>
		
		            <label for="duration">Duración (en segundos):</label>
		            <input type="number" class="input-form" id="duration" name="duration">
		            <br/>
		
		            <label for="type">Tipo:</label>
		            <input type="text" class="input-form" id="type" name="type">
		            <br/>
		
		            <label for="score">Partitura:</label>
		            <input type="file" class="input-form" id="file" name="file">
		            <br/>
		            
		            <label for="instrument[]">Instrumentos:</label>
		            <input type="text" class="input-form" id="instrument" name="instrument[]">
		            <br/>
		            <%
		            
		            
		            %>
		
		            <input type="submit" class="small-button" value="Subir">
		        </form>
		    </div>
		</div>
	</div>
</body>
</html>