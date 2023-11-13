import java.io.*;
import java.net.*;

public class Client{
  private static final int PORT = 3333;
  
  public static void main(String[] args){
    InetAddress addr = null;

    try{
      if(args.length > 0) addr = InetAddress.getByName(args[0]);
      else addr = InetAddress.getByName(null);
    }catch(UnknownHostException e) {
      System.out.println("Host non valido");
    }

    Socket s = null;
    BufferedReader in = null;
    BufferedReader stdin = null;
    PrintWriter out = null;

    try{
      s = new Socket(addr, PORT);
      in = new BufferedReader(new InputStreamReader(s.getInputStream()));
      stdin = new BufferedReader(new InputStreamReader(System.in));
      out = new PrintWriter(s.getOutputStream(), true);

      System.out.println("Client: starting...");


      try{
        String clientString = stdin.readLine();
        out.println(clientString);
        String response = in.readLine();
        System.out.println("Received: "+response);
      }catch(IOException e){
        e.printStackTrace();
      }
    }catch(IOException e){
      System.out.println("Can't create socket");
      e.printStackTrace();

    }

    try{
      s.close();
      in.close();
      out.close();
      stdin.close();
    }catch(IOException e){
      e.printStackTrace();
    }



  }
}

