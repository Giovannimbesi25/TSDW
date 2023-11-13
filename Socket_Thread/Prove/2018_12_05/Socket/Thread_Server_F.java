import java.io.*;
import java.net.*;

public class Thread_Server_F extends Thread{
  private Socket socket;
  private BufferedReader in;
  private PrintWriter out;
  public static String history = "";

  public Thread_Server_F(Socket clientSocket) throws IOException {
    socket = clientSocket; 
    in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
    out = new PrintWriter(socket.getOutputStream(), true);
    start();
    System.out.println("New connection with "+ socket);

  }

  public void run(){
    try{
      String receivedString;
      //istruzione fondamentale: blocca la socket sino a quando il client è connesso
      while((receivedString = in.readLine()) != null){
        System.out.println("Server_F received: "+ receivedString);
        out.println(list(receivedString));
      }
    }catch(IOException e){e.printStackTrace();}
    
    try {
      socket.close();
      in.close();
      out.close();
  } catch(IOException e) {}
  }


  public static String list(String s) {
    s = s.trim();
    if (s.equals("SHOW") || s.equals("SHOW\n")) {
        return history;
    }
    history += s + ";";
    return "OK";
  }
  
}
