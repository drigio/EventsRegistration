package com.example.drigio.eventregistrations;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Debug;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.RetryPolicy;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import java.io.Console;
import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity implements AdapterView.OnItemSelectedListener{

    ProgressBar progressBar;
    TextView username;
    Button submit;
    EditText fname,lname,college,email,mobile;
    Spinner eventSpinner;
    AlertDialog.Builder builder;
    final String server = "http://gpptech.000webhostapp.com/EventRegistration/Backend/insert.php";
    String eventid = "0",userid;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Bundle extras = getIntent().getExtras();
        username = findViewById(R.id.username);
        username.setText("Welcome " + extras.getString("name"));
        userid = extras.getString("userid");
        Log.d("my",userid);

        //Department Wise Events List Creation
        eventSpinner = (Spinner)findViewById(R.id.events);
        ArrayAdapter<String> madapter = new ArrayAdapter<String>(MainActivity.this,android.R.layout.simple_list_item_1,
                getResources().getStringArray(R.array.events));
        madapter.setDropDownViewResource(android.R.layout.simple_list_item_1);
        eventSpinner.setAdapter(madapter);
        eventSpinner.setOnItemSelectedListener(this);

        progressBar = findViewById(R.id.progressBar);
        progressBar.setVisibility(View.INVISIBLE);

        submit = (Button)findViewById(R.id.submit);

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(eventid.equals("0")) {
                    Toast.makeText(MainActivity.this,"First Select Event " + eventid,Toast.LENGTH_SHORT).show();
                }else {
                    submitDetails();
                }
            }
        });

    }

    //Create Options Menu
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater menuInflater = getMenuInflater();
        menuInflater.inflate(R.menu.menu_layout,menu);
        return true;
    }

    //Handling the option menu Clicks


    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.logout_menu :
                logout();
                return true;
            case R.id.about :
                Intent intent = new Intent(MainActivity.this,AboutActivity.class);
                startActivity(intent);
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    private void submitDetails() {
        //get all resources
        fname = (EditText)findViewById(R.id.fname);
        lname = (EditText)findViewById(R.id.lname);
        college = (EditText)findViewById(R.id.college);
        email = (EditText)findViewById(R.id.email);
        mobile = (EditText)findViewById(R.id.mobile);
        builder = new AlertDialog.Builder(MainActivity.this);

        //Create a String Request for uploading the data to server
        StringRequest request = new StringRequest(Request.Method.POST, server,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        builder.setTitle("Sever Response");
                        builder.setMessage(response);  //Response from our server
                        builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                               fname.setText("");
                               lname.setText("");
                               mobile.setText("");
                               college.setText("");
                               email.setText("");
                            }
                        });
                        progressBar.setVisibility(View.INVISIBLE);
                        AlertDialog alertDialog = builder.create();
                        alertDialog.show();
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressBar.setVisibility(View.INVISIBLE);
                Toast.makeText(MainActivity.this,"Error Occurred",Toast.LENGTH_SHORT).show();
                error.printStackTrace();
            }
        }){
            //Passing all the parameters here
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params = new HashMap<String, String>();
                params.put("fname",fname.getText().toString());
                params.put("lname",lname.getText().toString());
                params.put("college",college.getText().toString());
                params.put("email",email.getText().toString());
                params.put("mobile",mobile.getText().toString());
                params.put("eventid",eventid);
                params.put("userid",userid);
                return params;
            }
        };

        //Change the Retry Policy to extend the time taken to connect to the server
        request.setRetryPolicy(new RetryPolicy() {
            @Override
            public int getCurrentTimeout() {
                return 50000;
            }

            @Override
            public int getCurrentRetryCount() {
                return 50000;
            }

            @Override
            public void retry(VolleyError error) throws VolleyError {

            }
        });
        //Finally Add to a request Queue
        SingletonClass.getmInstance(MainActivity.this).addToRequestQueue(request);
        progressBar.setVisibility(View.VISIBLE);

    }

    @Override
    public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
        eventid = getEventId(i);
    }

    @Override
    public void onNothingSelected(AdapterView<?> adapterView) {

    }

    private String getEventId(int i) {
        return Integer.toString(i+1);
    }

    private void logout() {
        SharedPreferences sharedPreferences = getSharedPreferences("myprefs", Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear();
        editor.apply();
        Intent intent = new Intent(MainActivity.this,LoginActivity.class);
        finish();
        startActivity(intent);
    }
}
