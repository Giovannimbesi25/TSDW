package com.example;
import java.io.IOException;
import java.io.PrintWriter;
import jakarta.servlet.http.*;
import jakarta.servlet.*;
import java.sql.*;

public class filmWishListServlet extends HttpServlet{
    private Connection dbConnection = null;
    private static final String DATABASE_URL = "jdbc:mysql://localhost/php_db";
    private static final String USERNAME = "root";
    private static final String PASSWORD = "giovanni";

    @Override
    public void init(){
        try{
            dbConnection = DriverManager.getConnection(DATABASE_URL, USERNAME, PASSWORD);
            System.out.println("Connection established "+ dbConnection);
        }catch(SQLException e){e.printStackTrace();}
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException {
        PrintWriter out = response.getWriter();

        out.println("<html><head><title>Film Wish List</title></head><body>");

        out.println("<h1>Benvenuto nella tua lista film</h1><br>");


        try{
            String sql = "SELECT * from flist ORDER BY RAND() LIMIT 1";
            Statement statement = dbConnection.createStatement();
            ResultSet resultSet = statement.executeQuery(sql);

            if(resultSet.next()){
                out.println(":<h1>film consigliato: " + resultSet.getString("titolo") + "</h1>");
            }else{
                out.println("Nessun film presente nel database");
            }

        }catch(SQLException e){e.printStackTrace();}

        out.println("<br><br><h2>Inserisci il titolo e/o l'autore del film da cercare</h2>");

        out.println("<form method='post'>");
        out.println("<h4>Titolo: <input type='text' name='titolo' />");
        out.println("<h4>Regista: <input type='text' name='regista' />");
        out.println("<h4><input type='submit' value='search' name='action' />");
        out.println("</form>");


        out.println("<form method='post'>");
        out.println("<h4><input type='submit' value='WishList' name='action' />");
        out.println("</form>");

        out.println("</body><html>");
        
    }


    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException {
        PrintWriter out = response.getWriter();

        out.println("<html><head><title>Film Wish List</title></head><body>");
        out.println("<h1>Benvenuto nella tua lista film</h1><br>");
        String action = request.getParameter("action");

        switch(action){
            case "search" : {
                try{
                    String sql = "SELECT * from flist WHERE titolo = ? OR regista = ?";
                    PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                    preparedStatement.setString(1, request.getParameter("titolo"));
                    preparedStatement.setString(2, request.getParameter("regista"));
                    ResultSet resultSet = preparedStatement.executeQuery();
                    out.println("<ul>");
                    if(resultSet.next()){
                        do {
                            out.println("<li>");
                            out.println("<h4>Titolo: " + resultSet.getString("titolo") + " </h4>");
                            out.println("<h4>Regista: " + resultSet.getString("regista") + " </h4>");
                            out.println("</li>");

                        }while(resultSet.next());

                        out.println("<h4><a href='/films'>Torna alla home</a></h4>");
                    }else{
                        out.println("<h4>Questo titolo non è presente nella tua lista, vuoi inserirlo nella wList?</h4>");
                        out.println("<form method='post'>");
                        out.println("<input type='hidden' value=' " + request.getParameter("titolo") + "' name='titolo' />");
                        out.println("<input type='hidden' value=' " + request.getParameter("regista") + "' name='regista' />");
                        out.println("<input type='submit' value='si' name='action' />");
                        out.println("<input type='submit' value='no' name='action' />");
                        out.println("</form>");
                    }
                    out.println("</ul>");
                }catch(SQLException e){e.printStackTrace();}
            }break;

            case "no" : {
                response.sendRedirect(request.getContextPath()+"/films");
            }break;

            case "si" : {
                try{
                    String sql = "INSERT INTO wlist (titolo, regista) VALUES(?,?)";
                    PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                    preparedStatement.setString(1, request.getParameter("titolo"));
                    preparedStatement.setString(2, request.getParameter("regista"));
                    preparedStatement.executeUpdate();
                    out.println("<br><h4>Film inserito con successo nella wlist</h4><br>");
                    out.println("<h4><a href='/films'>Torna alla home</a></h4>");
                }catch(SQLException e){e.printStackTrace();}
            }break;
            
            case "WishList" : {
                try{
                    String sql = "SELECT * from wlist";
                    Statement statement = dbConnection.createStatement();
             
                    ResultSet resultSet = statement.executeQuery(sql);
                    out.println("<ul>");
                    if(resultSet.next()){
                        do {
                            out.println("<li>");
                            out.println("<h4>Titolo: " + resultSet.getString("titolo") + " </h4>");
                            out.println("<h4>Regista: " + resultSet.getString("regista") + " </h4>");
                            out.println("</li>");
                        }while(resultSet.next()); 
                        out.println("</ul>");


                        out.println("<form method='post'>");
                        out.println("<h4><input type='submit' value='Svuota' name='action' />");
                        out.println("</form>");
                    }else{
                        out.println("<h2>La Whish List è vuota");
                    }
                    out.println("<br><h4><a href='/films'>Torna alla home</a></h4>");

                }catch(SQLException e){e.printStackTrace();}
            }break;
            case "Svuota" : {
                try{
                    String sql = "TRUNCATE wlist";
                    Statement statement = dbConnection.createStatement();
                    statement.executeUpdate(sql);
                    out.println("<ul>");
                    out.println("<br><h4>wlist svuotata con successo</h4><br>");
                    out.println("<h4><a href='/films'>Torna alla home</a></h4>");

                }catch(SQLException e){e.printStackTrace();}
            }break;
        }
        out.println("</body><html>");
    }

    @Override
    public void destroy(){
        try{
            dbConnection.close();
        }catch(SQLException e){e.printStackTrace();}
    }


}