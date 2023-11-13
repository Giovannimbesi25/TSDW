import java.net.*;
import java.io.*;

public class nicotraEchoClient {
  public static final int PORT = 1050;
  public static final String SECRET = "end";

  public static void main(String[] args) throws IOException {

    InetAddress addr;

    if(args.length == 0)
      addr = InetAddress.getByName(null);
    else addr = InetAddress.getByName(args[0]);

    Socket socket = null;
    BufferedReader in = null, stdIn = null;
    PrintWriter out = null;

    try{

      socket = new Socket(addr, PORT);
      System.out.println("EchoClient: start");
      System.out.println("Client Socket: "+ socket);

      in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
      out = new PrintWriter(socket.getOutputStream(), true);
      stdIn = new BufferedReader(new InputStreamReader(System.in));

      String userInput;

      while(true){
        userInput = stdIn.readLine();
        out.println(userInput);
        if(userInput.equals(SECRET)){
          System.out.println("End of communication received by server "+ in.readLine());
          break;
        }
        System.out.println("Server Response: "+ in.readLine());
      }
    }
    catch(UnknownHostException e){
      System.err.println("Don't know about host " + addr);
      System.exit(1);
    }
    catch(IOException e){
        System.err.println("Couldn't get I/O for the connection to: "+ addr);
        System.exit(1);
    }
    try {
      System.out.println("EchoClient closing...");
      in.close();
      socket.close();
      out.close();
      stdIn.close();
    } catch (Exception e) {
      e.printStackTrace();
    }
  }
}
