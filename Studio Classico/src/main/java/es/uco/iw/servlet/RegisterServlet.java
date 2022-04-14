package es.uco.iw.servlet;

import java.io.IOException;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import es.uco.iw.controller.UserController;
import es.uco.iw.model.CustomerBean;
import es.uco.iw.model.User;
import es.uco.iw.model.UserType;

/**
 * Servlet implementation class RegisterServlet
 */
@WebServlet("/RegisterServlet")
public class RegisterServlet extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public RegisterServlet() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		response.sendRedirect(request.getContextPath() + "/register.jsp");
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		CustomerBean userBean = (CustomerBean) request.getSession().getAttribute("userBean");
		if (userBean != null) {
			if (userBean.getEmail() == null) {
				String email = request.getParameter("email");
				
				String password = request.getParameter("password");
				String nickname = request.getParameter("nickname");
				String firstname = request.getParameter("firstname");
				String lastname = request.getParameter("lastname");
				String phoneStr = request.getParameter("phone");
				
				UserController userController = new UserController();
				if (userController.getUserByEmail(email) != null) {
					String errorMsg = "Un usuario con este email ya existe";
					request.setAttribute("errorMsg", errorMsg);
					RequestDispatcher rd = request.getRequestDispatcher("/errorPage.jsp");
					rd.forward(request, response);
				}
				else if (firstname == null || lastname == null || email == null || password == null || phoneStr == null || firstname == "" || lastname == "" || email == "" || password == "" || phoneStr == "") {
					String errorMsg = "Uno o más campos de registro estaban vacíos";
					request.setAttribute("errorMsg", errorMsg);
					RequestDispatcher rd = request.getRequestDispatcher("/errorPage.jsp");
					rd.forward(request, response);
				}
				else {
					int phone = Integer.parseInt(phoneStr);
					
					User user = new User(-1, nickname, password, phone, firstname, lastname, email, UserType.USER);
					
					userController.saveUser(user);
					String msg = "Registrado correctamente";
					request.setAttribute("msg", msg);
					RequestDispatcher rd = request.getRequestDispatcher("/login.jsp");
					rd.forward(request, response);
				}
			}
			else {
				response.sendRedirect(request.getContextPath());
			}
		}
		else {
			response.sendRedirect(request.getContextPath());
		}
	}

}
