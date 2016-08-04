package id.situmorang.projectmonitoring.projectmonitoring;


import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.TextView;


public class MainActivity extends AppCompatActivity{
    TextView name ;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        name = (TextView)findViewById(R.id.nameOfuser);
        SessionUser su = new SessionUser();

        name.setText(su.getName());




    }


}



