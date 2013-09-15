vowel(a).
vowel(i).
vowel(u).
vowel(e).
vowel(o).

double(k).
double(p).
double(b).
double(t).
double(r).
double(s).

trans([X],X) :- vowel(X).

trans([k,a],ka).
trans([k,i],ki).
trans([k,u],ku).
trans([k,e],ke).
trans([k,o],ko).

trans([h,a],ha).
trans([h,i],hi).
trans([f,u],fu).
trans([h,e],he).
trans([h,o],ho).

trans([s,a],sa).
trans([s,h,i],shi).
trans([s,u],su).
trans([s,e],se).
trans([s,o],so).

trans([t,a],ta).
trans([c,h,i],chi).
trans([t,s,u],tsu).
trans([t,e],te).
trans([t,o],to).

trans([m,a],ma).
trans([m,i],mi).
trans([m,u],mu).
trans([m,e],me).
trans([m,o],mo).

trans([n,a],na).
trans([n,i],ni).
trans([n,u],nu).
trans([n,e],ne).
trans([n,o],no).

trans([r,a],ra).
trans([r,i],ri).
trans([r,u],ru).
trans([r,e],re).
trans([r,o],ro).

trans([y,a],ya).
trans([y,o],yo).
trans([y,u],yu).

trans([w,a],wa).
trans([w,o],wo).

trans([n],n).

trans([j,i], [shi,daku]).
trans([b,u], [fu,daku]).
trans([z,u], [tsu,daku]).
trans([g,V], [X,daku]) :- trans([k,V], X).
trans([z,V], [X,daku]) :- trans([s,V], X).
trans([d,V], [X,daku]) :- trans([t,V], X).
trans([b,V], [X,daku]) :- trans([h,V], X).

trans([p,u], [fu,handa]).
trans([p,V], [X,handa]) :- trans([h,V], X).

solve([],[]).
solve([C|[V|T]], [H|S]) :- trans([C,V], H) , solve(T, S).
solve([C|[C|[V|T]]], [[tsu,small]|[H|S]]) :- double(C), trans([C,V], H) , solve(T, S).

solve([j|[V|T]], [[shi,daku]|[[Y,small]|S]]) :- vowel(V) , trans([y, V], Y) , solve(T, S).
solve([C|[y|[V|T]]], [K|[[Y,small]|S]]) :- trans([C,i], K) , trans([y, V], Y) , solve(T, S).
solve([C1|[C2|[V|T]]], [H|S]) :- trans([C1,C2,V], H) , solve(T, S).
solve([C|[h|[V|T]]], [H|[[Y,small]|S]]) :- trans([C,h,i], H) , trans([y, V], Y) , solve(T, S).

solve([V|T],[V|S]) :- vowel(V) , solve(T, S).
solve([n|[V|X]],Z) :- vowel(V) , ! , fail.
solve([n|T],[n|S]) :- solve(T, S).
