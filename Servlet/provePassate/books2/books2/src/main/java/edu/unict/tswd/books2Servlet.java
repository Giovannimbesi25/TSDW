package edu.unict.tswd;

import jakarta.servlet.*;
import jakarta.servlet.http.*;
import java.sql.*;
import java.io.PrintWriter;
import java.io.IOException;

public class books2Servlet extends HttpServlet{
    private Connection dbConnection = null;
    private String DB_URL = "jdbc:mysql://localhost/php_db";
    private String USERNAME = "root";
    private String PASSWORD = "giovanni";

    @Override
    public void init(){
        try {
            dbConnection = DriverManager.getConnection(DB_URL,USERNAME, PASSWORD);
            System.out.println("DB connection established "+ dbConnection);
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException{
        PrintWriter out = response.getWriter();
        out.println("<html><head><title>Books2</title></head><body>");
        out.println("<h1>Benvenuto nella libreria</h1>");
        out.println("<br><h2>Inserisci un nuovo libro</h2>");
        out.println("<form method='post'>");
        out.println("<h4>ISBN <input type='text' name='isbn' required/></h4>");
        out.println("<h4>Title <input type='text' name='title' required/></h4>");
        out.println("<h4>Publisher <input type='text' name='publisher' required/></h4>");
        out.println("<h4>Price <input type='text' name='price' required/></h4>");
        out.println("<select name='author'>");
        try {
            String sql = "SELECT * from authors ";
            Statement statement = dbConnection.createStatement();
            ResultSet resultSet = statement.executeQuery(sql);
            while(resultSet.next()){
                out.println("<option value='"+ resultSet.getString("id")+ "'>"+resultSet.getString("firstname")+" "+ resultSet.getString("lastname")+ "</option>");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        out.println("</select>");
                out.println("<select name='country'>");
        try {
            String sql = "SELECT * from country ";
            Statement statement = dbConnection.createStatement();
            ResultSet resultSet = statement.executeQuery(sql);
            while(resultSet.next()){
                out.println("<option value='"+ resultSet.getString("id")+ "'>"+resultSet.getString("nicename")+"</option>");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        out.println("</select>");
        out.println("<input type='submit' name='action' value='insert' />");
        out.println("</form>");

        //Volendo si potrebbe fare con la stessa select che c'è sopra ma non è specificato
        out.println("<br><h2>Cerca i libri del tuo autore preferito</h2>");
        out.println("<form method='post'>");
            out.println("<h4>BookAuthor <input type='text' name='author' value='' /></h4>");
            out.println("<input type='submit' name='action' value='search' />");
        out.println("</form>");
        

        out.println("</body></html>");
    }

    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException{
        PrintWriter out = response.getWriter();

        out.println("<html><head><title>Books2</title></head><body>");

        if(request.getParameter("action") != null){
            switch(request.getParameter("action")){
                case "search" : {
                    try {
                        String sql = "SELECT * from authors where firstname = ?";
                        PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                        preparedStatement.setString(1, request.getParameter("author"));
                        ResultSet resultSet = preparedStatement.executeQuery();
                        if(resultSet.next()){
                            out.println("<h1>Ecco i libri scritti da "+ resultSet.getString("firstname")+"</h1>");
                            String sqlBooks = "SELECT * from books2 WHERE author = ?";
                            PreparedStatement preparedStatement2 = dbConnection.prepareStatement(sqlBooks);
                            preparedStatement2.setString(1, resultSet.getString("id"));
                            ResultSet resultSet2 = preparedStatement2.executeQuery();
                            if(resultSet2.next()){
                                out.println("<ul>");
                                do{
                                    out.println("<li>");
                                    out.println("<h4>ISBN: "+ resultSet2.getString("isbn")+ "</h4>");
                                    out.println("<h4>Title: "+ resultSet2.getString("title")+ "</h4>");
                                    out.println("<h4>Author: "+ resultSet2.getString("author")+ "</h4>");
                                    out.println("<h4>Publisher: "+ resultSet2.getString("publisher")+ "</h4>");
                                    out.println("<h4>Country: "+ resultSet2.getString("country")+ "</h4>");
                                    out.println("<h4>Price: "+ resultSet2.getString("price")+ "</h4>");
                                    out.println("</li>");
                                }while(resultSet2.next());
                                out.println("</ul>");
                            }else{
                                out.println("<h1>Non sono associati libri all'autore "+ resultSet.getString("firstname"));
                            }
                        }else{
                            out.println("<h1>L'autore "+ request.getParameter("author") + " non esiste</h1>");
                        }
                    } catch (SQLException e) {
                        e.printStackTrace();
                    }

                    out.println("<br><br><a href='/books'><h3>Torna alla home</h3></a>");
                }break;
                
                case "insert" : {
                    try {
                        String sqlCounty = "SELECT * from country WHERE id = ?";
                        PreparedStatement preparedStatement = dbConnection.prepareStatement(sqlCounty);
                        preparedStatement.setString(1, request.getParameter("country"));
                        ResultSet resultSet = preparedStatement.executeQuery();
                        double price=0;
                        if(resultSet.next()){
                            if(resultSet.getString("nicename") == "Italy"){
                                price = Integer.parseInt(request.getParameter("price")) * 1.1;
                            }else{
                                price = Integer.parseInt(request.getParameter("price")) * 1.2;                               
                            }
                        }
                        try {
                            String sqlBooks = "INSERT INTO books2 (isbn, title, author, publisher, country, price) VALUES(?,?,?,?,?,?)";
                            PreparedStatement preparedStatement2 = dbConnection.prepareStatement(sqlBooks);
                            preparedStatement2.setString(1, request.getParameter("isbn"));
                            preparedStatement2.setString(2, request.getParameter("title"));
                            preparedStatement2.setString(3, request.getParameter("author"));
                            preparedStatement2.setString(4, request.getParameter("publisher"));
                            preparedStatement2.setString(5, request.getParameter("country"));
                            preparedStatement2.setDouble(6, price);
                            preparedStatement2.executeUpdate();
                            System.out.println("update effettuato");

                            response.sendRedirect("/books");
                        } catch (SQLException e) {
                            e.printStackTrace();
                        }

                    } catch (SQLException e) {
                        e.printStackTrace();
                    }
                }break;
            }
        }

        out.println("</body></html>");
    }



    @Override
    public void destroy(){
        try {
            dbConnection.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
