<%@ page import="es.uco.iw.model.Instrument, java.util.ArrayList" %>
<jsp:useBean id="userBean" scope="session" class="es.uco.iw.model.UserBean"></jsp:useBean>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%
	if (userBean.getEmail() == null){
		request.setAttribute("errorMsg", "No ha iniciado sesi�n");
		RequestDispatcher rd = request.getRequestDispatcher("/errorPage.jsp");
		rd.forward(request, response);
	}
	ArrayList<Instrument> instruments = (ArrayList<Instrument>) request.getAttribute("instruments"); 
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
		        <form action="<%= request.getContextPath() %>/addInstrumentToPiece" method="GET">
		            
		            <label>Instrumentos:</label>
		            <br/>
		            <%
		            for (Instrument i : instruments){
		            	int ii = 0;
		            	%>
		            	
		            	<label for="count<%=i.getID()%>"><%=i.getName() %> Cantidad</label>
		            	<input type="number" class="input-form" id="instrument<%=i.getID()%>" name="instrument[][<%=i.getID()%>]">
		            	<br/>
		            	<%
		            	ii++;
		            }
		            	
		            %>
		            
		            <%
		            
		            %>
		
		            <input type="submit" class="small-button" value="Siguiente">
		        </form>
		    </div>
		</div>
	</div>
</body>
</html>