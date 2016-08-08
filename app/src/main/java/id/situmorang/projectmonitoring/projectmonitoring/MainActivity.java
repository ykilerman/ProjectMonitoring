package id.situmorang.projectmonitoring.projectmonitoring;


import android.content.Intent;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;


public class MainActivity extends AppCompatActivity{
    TextView tulisan ;
    Button blogout;
    SessionUser session;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        session = new SessionUser();

        String name=session.getName(MainActivity.this, "name");
        String position=session.getPosition(MainActivity.this, "position");

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        tulisan = (TextView) findViewById(R.id.tulisan);
        blogout = (Button) findViewById(R.id.btn_logout);

        if (position ==""){
            Intent intent = new Intent(this, Login.class);
            startActivity(intent);
        }else {
            tulisan.setText("Selamat Datang "+name+" anda login Sebagai "+position);
        }


        blogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                session.setName(MainActivity.this, "name", "");
                session.setUsername(MainActivity.this, "username", "");
                session.setPosition(MainActivity.this, "position", "");
                Intent intent = new Intent(getApplicationContext(), Login.class);
                startActivity(intent);
                finish();
            }
        });
    }


}



