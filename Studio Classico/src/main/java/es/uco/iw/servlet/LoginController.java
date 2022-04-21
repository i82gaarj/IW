package es.uco.iw.servlet;

import java.io.IOException;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import es.uco.iw.controller.UserDAO;
import es.uco.iw.model.User;
import es.uco.iw.model.UserBean;

/**
 * Servlet implementation class UserController
 */
@WebServlet(name="LoginController", urlPatterns="/login")
public class LoginController extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public LoginController() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		RequestDispatcher rd = request.getRequestDispatcher("/login.jsp");
		rd.forward(request, response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		login(request, response);
	}
	
	protected void login(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		String email = request.getParameter("email");
		String password = request.getParameter("password");
		
		if (email.equals("") || password.equals("")) {
			String errorMsg = "Complete los campos del login";
			request.setAttribute("errorMsg", errorMsg);
			RequestDispatcher rd = request.getRequestDispatcher("/errorPage.jsp");
			rd.forward(request, response);
		}
		else {
			UserDAO userController = new UserDAO();
			User user = userController.getUserByEmail(email);
			
			UserBean userBean = (UserBean) request.getSession().getAttribute("userBean");
			
			if(user != null) {
				if (user.getPassword().equals(password)) {
									
					userBean.setEmail(user.getEmail());
					userBean.setFirstName(user.getFirstName());
					userBean.setLastName(user.getFirstName());
					userBean.setID(user.getID());
					
					response.sendRedirect("index.jsp");
				}
				else {
					String errorMsg = "El usuario y/o la contraseña no coinciden con nuestros registros";
					request.setAttribute("errorMsg", errorMsg);
					RequestDispatcher rd = request.getRequestDispatcher("/errorPage.jsp");
					rd.forward(request, response);
				}
			}
			else {
				String errorMsg = "El usuario y/o la contraseña no coinciden con nuestros registros";
				request.setAttribute("errorMsg", errorMsg);
				RequestDispatcher rd = request.getRequestDispatcher("/errorPage.jsp");
				rd.forward(request, response);
			}
		}
		
	}

}
