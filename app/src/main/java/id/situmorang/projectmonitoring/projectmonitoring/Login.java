package id.situmorang.projectmonitoring.projectmonitoring;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.TimeoutError;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import butterknife.ButterKnife;

public class Login extends AppCompatActivity {
    private static final String TAG = "LoginActivity";
    private static final int REQUEST_SIGNUP = 0;
    EditText _userText;
    EditText _passwordText;
    Button _loginButton;
    TextView _signupLink;
    String cek ="";

    AlertDialog.Builder builder;
    SessionUser session;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        session = new SessionUser();
        setContentView(R.layout.activity_login);
//        String status=session.getPosition(Login.this, "position");
//        if (status != null || !status.isEmpty()){
//            Intent intent = new Intent(this, MainActivity.class);
//            startActivity(intent);
//        }
        _userText = (EditText)findViewById(R.id.input_user);
        _passwordText = (EditText)findViewById(R.id.input_password);
        _loginButton = (Button)findViewById(R.id.btn_login);
        _signupLink = (TextView)findViewById(R.id.link_signup);
        builder = new AlertDialog.Builder(Login.this);
        ButterKnife.bind(this);


        _loginButton.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                login();
            }
        });

        _signupLink.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // Start the Signup activity
                Intent intent = new Intent(getApplicationContext(), Register.class);
                startActivityForResult(intent, REQUEST_SIGNUP);
            }
        });

    }

    public void login() {
        Log.d(TAG, "Login");

        if (!validate()) {
            onLoginFailed();
            return;
        }
        loginUser();

        _loginButton.setEnabled(false);

        final ProgressDialog progressDialog = new ProgressDialog(Login.this,
                R.style.AppTheme_Dark_Dialog);
        progressDialog.setIndeterminate(true);
        progressDialog.setMessage("Authenticating...");
        progressDialog.show();

        String email = _userText.getText().toString();
        String password = _passwordText.getText().toString();

        // TODO: Implement your own authentication logic here.

        new android.os.Handler().postDelayed(
                new Runnable() {
                    public void run() {

                        progressDialog.dismiss();
                    }
                }, 3000);
    }


    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (requestCode == REQUEST_SIGNUP) {
            if (resultCode == RESULT_OK) {

                // TODO: Implement successful signup logic here
                // By default we just finish the Activity and log them in automatically
                this.finish();

            }
        }
    }

    @Override
    public void onBackPressed() {
        // Disable going back to the MainActivity
        moveTaskToBack(true);
    }

    public void onLoginSuccess() {
        _loginButton.setEnabled(true);
        finish();
        Intent intent = new Intent(getApplicationContext(), MainActivity.class);
        startActivityForResult(intent, REQUEST_SIGNUP);

    }

    public void onLoginFailed() {
        builder.setTitle("Warning!!!");
        builder.setMessage("Please Fill all the fields");
        builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {

            @Override
            public void onClick(DialogInterface dialogInterface, int which) {


            }
        });

        AlertDialog ad = builder.create();
        ad.show();

        _loginButton.setEnabled(true);
    }

    public boolean validate() {
        boolean valid = true;

        String username = _userText.getText().toString();
        String password = _passwordText.getText().toString();

        if (username.isEmpty() ) {
            _userText.setError("your Username require");
            valid = false;
        } else {
            _userText.setError(null);
        }

        if (password.isEmpty() || password.length() < 6) {
            _passwordText.setError("Minimum Password Must be 6 characters");
            valid = false;
        } else {
            _passwordText.setError(null);
        }

        return valid;
    }

    public void loginUser(){
        String url ="http://192.168.0.121/pmonitoring/login.php";

        StringRequest stringRequest = new StringRequest(Request.Method.POST,url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                session = new SessionUser();
                String nama="" ;
                String username="" ;
                String position="" ;


                _loginButton.setEnabled(true);

                try {
                    JSONArray jArray = new JSONArray(response);
                    JSONObject jObj =jArray.getJSONObject(0);
                    nama = jObj.getString("name");
                    username = jObj.getString("username");
                    position = jObj.getString("position");
                    cek = jObj.getString("name");

                } catch (JSONException e) {
                    e.printStackTrace();
                }

                session.setName(Login.this, "name", nama);
                session.setUsername(Login.this, "username", username);
                session.setPosition(Login.this, "position", position);

                if (nama.equalsIgnoreCase("error")){
                    builder.setTitle("Message");
                    builder.setMessage("Username or password is incorrect");
                    builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {
                            _userText.setText("");
                            _passwordText.setText("");
                        }
                    });
                    AlertDialog alertDialog = builder.create();
                    alertDialog.show();
                    _loginButton.setEnabled(true);
                }else if (nama.equalsIgnoreCase("error_connection")){
                    builder.setTitle("Warning!!!");
                    builder.setMessage("there is a problem with your database connection");
                    builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {
                            _userText.setText("");
                            _passwordText.setText("");
                        }
                    });
                    AlertDialog ald = builder.create();
                    ald.show();
                    _loginButton.setEnabled(true);
                }else if (cek == ""){
                    builder.setTitle("Warning!!!");
                    builder.setMessage("can't access your server, cek your connection or your server");
                    builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {
                            _userText.setText("");
                            _passwordText.setText("");
                        }
                    });
                    AlertDialog alt = builder.create();
                    alt.show();
                    _loginButton.setEnabled(true);
                }else{
                    onLoginSuccess();
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError volleyError) {
                if (volleyError instanceof TimeoutError) {
                }
            }
        }) {
            @Override
            public Map<String, String> getParams() throws AuthFailureError {
                HashMap<String, String> headers = new HashMap<>();
                headers.put("username", _userText.getText().toString());
                headers.put("password", _passwordText.getText().toString());
                return headers;
            }

            @Override
            public Priority getPriority() {
                return Priority.IMMEDIATE;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

}