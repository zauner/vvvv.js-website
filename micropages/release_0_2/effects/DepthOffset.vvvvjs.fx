#ifdef GL_ES
precision highp float;
#endif

uniform mat4 tW : WORLD;
uniform mat4 tV : VIEW;
uniform mat4 tP : PROJECTION;

uniform float Near = 0.0;
uniform float Far = 100.0;
uniform float Reference_Depth = 0.0;

varying float vs2psValue;

vertex_shader:

attribute vec3 PosO : POSITION;

void main(void) {

  mat4 tWV = tV * tW;
  mat4 tWVP = tP * tWV;
  
  vec4 PosV = tWV * vec4(PosO, 1.0);
  vs2psValue = min(1.0, abs(PosV.z - Reference_Depth) / (Far - Near)); 
  gl_Position = (tWVP * vec4(PosO, 1.0));
}

fragment_shader:

void main(void) {
  
  gl_FragColor = vec4(vs2psValue, vs2psValue, vs2psValue, 1.0);

}


