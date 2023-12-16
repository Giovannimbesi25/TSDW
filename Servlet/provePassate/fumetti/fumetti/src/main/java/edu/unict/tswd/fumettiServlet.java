package edu.unict.tswd;

import java.io.PrintWriter;
import jakarta.servlet.*;
import jakarta.servlet.http.*;
import java.sql.*;
import java.io.IOException;

public class fumettiServlet extends HttpServlet{
    Connection dbConnection = null;
    @Override
    public void init(){
        try{
            dbConnection = DriverManager.getConnection("jdbc:mysql://localhost/php_db", "root", "giovanni");
            System.out.println("Connection established "+ dbConnection);
            // Statement statement = dbConnection.createStatement();
            // String sql = "CREATE TABLE fumetti(id INT AUTO_INCREMENT PRIMARY KEY, titolo VARCHAR(100), genere VARCHAR(50), autore VARCHAR(50))";
            // statement.execute(sql);
            // System.out.println("Tabella creata");
        }catch(SQLException e){e.printStackTrace();}    
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException{
        PrintWriter out = response.getWriter();
        out.println("<html><head><title>Fumetti Store</title></head><body>");

        if(request.getParameter("id")!=null){
            out.println("<h1>About Page</h2>");

            try{
                String sql = "SELECT * from fumetti WHERE id=?";
                PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                preparedStatement.setString(1, request.getParameter("id"));
                ResultSet resultSet = preparedStatement.executeQuery();
                if(resultSet.next()){
                    out.println("<form method='post'>");
                    out.println("<input hidden name='id' value='"+resultSet.getString("id")+"'/>");
                    out.println("<h4>Titolo: <input type='text' name='titolo' required value='"+resultSet.getString("titolo")+"'/></h4>");
                    out.println("<h4>Genere: <input type='text' name='genere' required value='"+resultSet.getString("genere")+"'/></h4>");
                    out.println("<h4>Autore: <input type='text' name='autore' required value='"+resultSet.getString("autore")+"'/></h4>");
                    out.println("<input type='submit' value='update' name='action' />");
                    out.println("<input type='submit' value='delete' name='action' />");
                    out.println("</form>");
                }else{
                    out.println("<h1>Fumetto non trovato</h1>");
                }
            }catch(SQLException e){e.printStackTrace();}
            
            out.println("<br><br><a href='/fumetti'><h3>Ritorna alla home</h3></a>");
        }else{

            out.println("<h1>Benvenuto nel fumetti store</h1><br>");

            try{
                String sql = "SELECT * FROM fumetti ORDER BY id DESC LIMIT 3";
                Statement statement = dbConnection.createStatement();
                ResultSet resultSet = statement.executeQuery(sql);
                if(resultSet.next()){
                    out.println("<h2>Ecco alcuni fumetti dal nostro store </h2>");
                    out.println("<ul>");
                    do{
                        out.println("<li>");
                        out.println("<a href='/fumetti?id="+ resultSet.getString("id") + "'><h3>" + resultSet.getString("titolo")+"</h3></a>");
                        out.println("</li>");
                    }while(resultSet.next());
                    out.println("</ul>");
                }else{
                    out.println("<h2>Non ci sono fumetti</h2>");
                }
            }catch(SQLException e) {e.printStackTrace();}


            out.println("<br><br><h2>Cerca un fumetto</h2>");

            out.println("<form method='post'>");
            out.println("<h3>Titolo <input required type='text' name='titolo' /></h3>");
            out.println("<input  type='submit' name='action' value='search' />");
            out.println("</form>");
        }

        out.println("</body></html>");
    }

    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException{
        PrintWriter out = response.getWriter();
        out.println("<html><head><title>Fumetti Store</title></head><body>");

        String action = request.getParameter("action");
        switch(action){
            case "search" : {
                try{
                    String sql = "SELECT * from fumetti WHERE titolo=?";
                    PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                    preparedStatement.setString(1, request.getParameter("titolo"));
                    ResultSet resultSet = preparedStatement.executeQuery();
                    if(resultSet.next()){
                        response.sendRedirect("/fumetti?id="+ resultSet.getString("id"));
                    }else{
                        out.println("<h2>Il fumetto non è presente, aggiungilo</h2>");
                        out.println("<form method='post'>");
                        out.println("<h4>Titolo: <input type='text' value='"+request.getParameter("titolo")+"' required name='titolo'/></h4>");
                        out.println("<h4>Genere: <input type='text' required name='genere'/></h4>");
                        out.println("<h4>Autore: <input type='text' required name='autore'/></h4>");
                        out.println("<input type='submit' value='aggiungi' name='action'/></h4>");
                        out.println("</form>");

                        out.println("<br><br><a href='/fumetti'><h3>Ritorna alla home</h3></a>");
                    }
                }catch(SQLException e){e.printStackTrace();}
            }break;
            case "aggiungi" : {
                try{
                    String sql = "INSERT INTO fumetti (titolo, genere, autore) VALUES(?,?,?)";
                    PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                    preparedStatement.setString(1, request.getParameter("titolo"));
                    preparedStatement.setString(2, request.getParameter("genere"));
                    preparedStatement.setString(3, request.getParameter("autore"));
                    preparedStatement.executeUpdate();
                    System.out.println("Fumetto inserito");
                    response.sendRedirect("/fumetti");
                }catch(SQLException e){e.printStackTrace();}
            }break;
            case "delete" : {
                try{
                    String sql = "DELETE FROM fumetti WHERE titolo=?";
                    PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                    preparedStatement.setString(1, request.getParameter("id"));
                    preparedStatement.executeUpdate();
                    System.out.println("Fumetto eliminato");
                    response.sendRedirect("/fumetti");
                }catch(SQLException e){e.printStackTrace();}
            }break;
            case "update" : {
                try{
                    String sql = "UPDATE fumetti SET titolo=?, genere=?, autore=? WHERE id=?";
                    PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                    preparedStatement.setString(1, request.getParameter("titolo"));
                    preparedStatement.setString(2, request.getParameter("genere"));
                    preparedStatement.setString(3, request.getParameter("autore"));
                    preparedStatement.setString(4, request.getParameter("id"));
                    preparedStatement.executeUpdate();
                    System.out.println("Fumetto aggiornato");
                    response.sendRedirect("/fumetti");
                }catch(SQLException e){e.printStackTrace();}
            }break;
        }

        out.println("</body></html>");
    }
}