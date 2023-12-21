package edu.unict.tswd;

import java.io.PrintWriter;
import java.io.IOException;
import jakarta.servlet.*;
import jakarta.servlet.http.*;
import java.sql.*;

public class booksServlet extends HttpServlet{
    private Connection dbConnection = null;
    private String DB_URL = "jdbc:mysql://localhost/php_db";
    private String DB_USERNAME = "root";
    private String DB_PASSWORD = "giovanni";

    @Override
    public void init(){
        try {
            dbConnection = DriverManager.getConnection(DB_URL, DB_USERNAME, DB_PASSWORD);
            System.out.println("Connection established");
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        PrintWriter out = response.getWriter();
        out.println("<html><head><title>Books</title></head><body>");
        if(request.getParameter("isbn")!=null){
            try {
                String sql = "SELECT * from books WHERE isbn = ?";
                PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                preparedStatement.setString(1, request.getParameter("isbn"));
                ResultSet resultSet = preparedStatement.executeQuery();
                if(resultSet.next()){
                    out.println("<h1>Aggiorna o elimina il libro</h1><br>");
                    out.println("<form method='post'>");
                    out.println("<input type='hidden' required  value='"+resultSet.getString("id")+"' name='id'  />");
                    out.println("<h3>ISBN: <input type='number' required value='"+request.getParameter("isbn")+"' name='isbn' /></h3>");
                    out.println("<h3>Title: <input type='text' required  value='"+resultSet.getString("title")+"' name='title'  /></h3>");
                    out.println("<h3>Author: <input type='text' required value='"+resultSet.getString("author")+"' name='author' /></h3>");
                    out.println("<h3>Publisher: <input type='text' required value='"+resultSet.getString("publisher")+"' name='publisher' /></h3>");
                    out.println("<h3>Ranking: <input type='number' required value='"+resultSet.getString("ranking")+"' name='ranking' /></h3>");
                    out.println("<h3>Year: <input type='number' required value='"+resultSet.getString("year")+"' name='year' /></h3>");
                    out.println("<h3>Price: <input type='number' required value='"+resultSet.getString("price")+"' name='price' /></h3>");
                    out.println("<input type='submit'  name='action' value='update'/>");
                    out.println("<input type='submit'  name='action' value='delete'/>");
                    out.println("</form>");
                }else{
                    out.println("<h1>Libro non disponibile</h1>");
                }

                out.println("<br><br><a href='/books?list=list'><h4>Torna alla lista</h4></a>");
            } catch (SQLException e) {
                e.printStackTrace();
            }

        }else if(request.getParameter("list")!= null && request.getParameter("list").equals("list") ){
            
            try{
                String sql ="SELECT * from books";
                Statement statement = dbConnection.createStatement();
                ResultSet resultSet = statement.executeQuery(sql);
                if(resultSet.next()){
                    out.println("<ul>");
                    out.println("<h1>Ecco la lista dei libri presenti</h1>");
                    do{
                        out.println("<li>");
                        out.println("<a href='/books?isbn="+ resultSet.getString("isbn")+"'><h4>ISBN: "+resultSet.getString("isbn")+"</h4></a>");
                        out.println("<h4>Title: "+resultSet.getString("title")+"</h4></a>");
                        out.println("<h4>Author: "+resultSet.getString("author")+"</h4></a>");
                        out.println("<h4>Publisher: "+resultSet.getString("publisher")+"</h4></a>");
                        out.println("<h4>Ranking: "+resultSet.getString("ranking")+"</h4></a>");
                        out.println("<h4>Year: "+resultSet.getString("year")+"</h4></a>");
                        out.println("<h4>Price: "+resultSet.getString("price")+"</h4></a>");
                        out.println("</li>");
                    }while(resultSet.next());
                    out.println("</ul>");
                }else{out.println("<h1>Non ci sono libri</h1>");}

                out.println("<h2>Inserisci un nuovo libro</h2>");
                out.println("<form method='post'>");
                out.println("<h4>ISBN: <input type='number' required name='isbn' /></h4>");
                out.println("<h4>Title: <input type='text' required name='title' /></h4>");
                out.println("<h4>Author: <input type='text' required name='author' /></h4>");
                out.println("<h4>Publisher: <input type='text' required name='publisher' /></h4>");
                out.println("<h4>Ranking: <input type='number' required name='ranking' /></h4>");
                out.println("<h4>Year: <input type='number' required name='year' /></h4>");
                out.println("<h4>Price: <input type='number' required name='price' /></h4>");
                out.println("<input type='submit'  name='action' value='insert'/></h4>");
                out.println("</form>");
            }catch(SQLException e){e.printStackTrace();}

        }else{
            out.println("<h1>Benvenuto nella libreria, clicca il pulsante per vedere i libri</h1>");
            out.println("<form method='get'>");
            out.println("<input type='submit' value='list' name='list'/>");
            out.println("</form>");
            
        }

        out.println("</body></html>");
    }


    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        PrintWriter out = response.getWriter();
        out.println("<html><head><title>Books</title></head><body>");
        
        if(request.getParameter("action") != null){
            switch(request.getParameter("action")){
                case "insert": {
                    try{
                        String sql ="INSERT INTO books (isbn, title, author, publisher, ranking, year, price) VALUES (?,?,?,?,?,?,?)";
                        PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                        preparedStatement.setString(1, request.getParameter("isbn"));
                        preparedStatement.setString(2, request.getParameter("title"));
                        preparedStatement.setString(3, request.getParameter("author"));
                        preparedStatement.setString(4, request.getParameter("publisher"));
                        preparedStatement.setString(5, request.getParameter("ranking"));
                        preparedStatement.setString(6, request.getParameter("year"));
                        preparedStatement.setString(7, request.getParameter("price"));
                        preparedStatement.executeUpdate();
                        response.sendRedirect("/books?list=list");

                    }catch(SQLException e){e.printStackTrace();}
                }break;
                case "update": {
                    try{
                        String sql ="UPDATE books set isbn=?, title=?, author=?, publisher=?, ranking=?, year=?, price=? WHERE id=?";
                        PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                        preparedStatement.setString(1, request.getParameter("isbn"));
                        preparedStatement.setString(2, request.getParameter("title"));
                        preparedStatement.setString(3, request.getParameter("author"));
                        preparedStatement.setString(4, request.getParameter("publisher"));
                        preparedStatement.setString(5, request.getParameter("ranking"));
                        preparedStatement.setString(6, request.getParameter("year"));
                        preparedStatement.setString(7, request.getParameter("price"));
                        preparedStatement.setString(8, request.getParameter("id"));
                        preparedStatement.executeUpdate();

                        response.sendRedirect("/books?isbn="+request.getParameter("isbn"));
                    }catch(SQLException e){e.printStackTrace();}
                }break;
                case "delete": {
                    try{
                        String sql ="DELETE FROM books WHERE id = ?";
                        PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                        preparedStatement.setString(1, request.getParameter("id"));
                        preparedStatement.executeUpdate();

                        response.sendRedirect("/books?list=list");
                    }catch(SQLException e){e.printStackTrace();}
                }break;
            }
        }

        out.println("</body></html>");
    }

    @Override
    public void destroy(){
        try {
            dbConnection.close();
            System.out.println("Connection close");
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
