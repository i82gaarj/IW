<%@ page import="es.uco.iw.model.Instrument, java.util.ArrayList, es.uco.iw.model.InstrumentCount" %>
<jsp:useBean id="userBean" scope="session" class="es.uco.iw.model.UserBean"></jsp:useBean>
<jsp:useBean id="pieceBean" scope="session" class="es.uco.iw.model.PieceBean"></jsp:useBean>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%
	if (userBean.getEmail() == null){
		request.setAttribute("errorMsg", "No ha iniciado sesión");
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
		        <form action="<%= request.getContextPath() %>/addPiece?action=addInst" method="POST">
		            
		            <label>Instrumentos:</label>
		            <br/>
		            <%
		            for (Instrument i : instruments){
		            	int ii = 0;
		            	%>
		            	<label for="instrument"><%=i.getName() %></label>
		            	<input type="hidden" class="input-form" id="instrument" name="instrument" value="<%=i.getID()%>">

		            	<label for="count">Cantidad</label>
		            	<input type="number" class="input-form" id="count" name="count">
		            	<br/>
		            	<%
		            	ii++;
		            }
		            %>
		
		            <input type="submit" class="small-button" value="Añadir">
		        </form>
		        
		        <p>Instrumentos añadidos:</p>
		        <%
		        ArrayList<InstrumentCount> currentInstruments = pieceBean.getInstruments();
		        if (currentInstruments == null){
		        %>
		        	<p>No se han añadido instrumentos
		        <%
		        }else{
			        for (InstrumentCount ic : currentInstruments){
			        %>
			        	<p><%=ic.getCount() %> x <%=ic.getInstrument().getName() %></p>
			        	<form action="<%= request.getContextPath() %>/addPiece?action=removeInst" method="POST">
			        	<input type="hidden" id="name" name="instrument" value="<%=ic.getInstrument().getID()%>">
			        	<input type="submit" class="small-button" value="Eliminar">
			        	</form>
			        <%
			        }
		        }    
			    %>
		        <button onclick="window.location.href='<%= request.getContextPath() %>/addPiece?action=addScore'">Continue</button>

		    </div>
		</div>
	</div>
</body>
</html>