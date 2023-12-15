package com.example;
import jakarta.servlet.http.*;
import jakarta.servlet.*;
import java.io.PrintWriter;
import java.io.IOException;
import java.sql.*;


public class prodottiServlet extends HttpServlet{
    private Connection dbConnection = null;

    @Override
    public void init(){
        try {
          dbConnection = DriverManager.getConnection("jdbc:mysql://localhost/php_db", "root", "giovanni");      
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException{
        PrintWriter out = response.getWriter();
        out.println("<html><head><title>Prodotti</title></head><body>");

        out.println("<h1>Benvenuto nel tuo magazzino</h1>");

        try {
            String sql = "SELECT * from prodotti WHERE giacenza>0";
            Statement statement = dbConnection.createStatement();
            ResultSet resultSet = statement.executeQuery(sql);
            if(resultSet.next()){
                do{
                    out.println("<form method='post' >");
                    out.println("<input name='id' value='"+ resultSet.getString("id") + "' hidden />");
                    out.println("<h4>Nome: <input name='nome_prodotto' value='"+ resultSet.getString("nome_prodotto") + "'  /></h4>");
                    out.println("<h4>Giacenza: <input name='giacenza' value='"+ resultSet.getString("giacenza") + "'  /></h4>");
                    out.println("<h4>Prezzo: <input name='prezzo' value='"+ resultSet.getString("prezzo") + "'  /></h4>");
                    out.println("<input value='compra' name='action' type='submit' />");
                    out.println("<input value='elimina' name='action' type='submit' />");
                    out.println("</form>");
                }while(resultSet.next());
            }else{
                out.println("<h2>Lista prodotti vuota</h2>");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        out.println("<br><h2>Aggiungi un nuovo prodotto</h2>");
        out.println("<form method='post' >");
        out.println("<h4>Nome: <input name='nome_prodotto' type='text' /></h4>");
        out.println("<h4>Giacenza: <input name='giacenza' type='number' /></h4>");
        out.println("<h4>Prezzo: <input name='prezzo' type='number' /></h4>");
        out.println("<input value='inserisci' name='action' type='submit' />");
        out.println("</form>");


        out.println("</body></html>");
    }


    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException{
        PrintWriter out = response.getWriter();
        out.println("<html><head><title>Prodotti</title></head><body>");
        String action = request.getParameter("action");
        switch (action) {
            case "inserisci": {
                try {
                    String sql = "INSERT INTO prodotti (nome_prodotto, giacenza, prezzo) VALUES (?, ?, ?)";
                    PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                    preparedStatement.setString(1, request.getParameter("nome_prodotto"));
                    preparedStatement.setInt(2, Integer.parseInt(request.getParameter("giacenza")));
                    preparedStatement.setInt(3, Integer.parseInt(request.getParameter("prezzo")));
                    preparedStatement.executeUpdate();
                    response.sendRedirect("/prodotti");
                } catch (SQLException e) {
                    e.printStackTrace();
                }
            }break;
            case "compra": {
                try {
                    int nuova_giacenza = Integer.parseInt(request.getParameter("giacenza")) -1;
                    String sql = "UPDATE prodotti SET giacenza=? WHERE id=?";
                    PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                    preparedStatement.setInt(1, nuova_giacenza);
                    preparedStatement.setInt(2, Integer.parseInt(request.getParameter("id")));
                    preparedStatement.executeUpdate();
                    response.sendRedirect("/prodotti");
                } catch (SQLException e) {
                    e.printStackTrace();
                }
            }break;
            case "elimina": {
                try {
                    String sql = "DELETE FROM prodotti WHERE id = ?";
                    PreparedStatement preparedStatement = dbConnection.prepareStatement(sql);
                    preparedStatement.setInt(1, Integer.parseInt(request.getParameter("id")));
                    preparedStatement.executeUpdate();
                    response.sendRedirect("/prodotti");
                } catch (SQLException e) {
                    e.printStackTrace();
                }
            }break;

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