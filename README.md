This is a very simple bootrap column plug-in. It suports Bootstrap fluid responsive layout. It assumes you have a bootstrap template, like Protostar.

At the relevant viewport, typically 768 pixels wide, the columns will switch from being side-by-side to being on-top of each other.

Primary syntax, this plug-in supports 2, 3, 4, 6 or 12 columns, as per the bootstrap 12 grid system

Seconday syntax, by placing {split} in your content the text prior with be put in a span8 div whilst the text after will be put in a span4 div.

Tertiary syntax, by placing {splitleft} in your content the text prior with be put in a span4 div whilst the text after will be put in a span8 div.

These syntaxes cannot be used together.

To use it, just use the following syntaxes in your articles:

Primary syntax:

    {cols}
    This is my first column, as much text as you like here. 
    {colbr}
    This is my second column, as much text as you like here, or images by the way. 
    {colbr}
    This is my third column, content can be whatever. 
    {/cols} 
    

Secondary syntax:

    This is my first column, it'll be span8 blah blah 
    {split}
    This is my second column, it'll be span4 blah blah 
    

Tertiary syntax:

    This is my first column, it'll be span4 blah blah 
    {splitleft}
    This is my second column, it'll be span8 blah blah 
    
