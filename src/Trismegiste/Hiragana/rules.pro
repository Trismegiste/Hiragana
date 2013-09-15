% declares vowel 
vowel(a).
vowel(i).
vowel(u).
vowel(e).
vowel(o).

% declares letters that could be doubled like attakai
double(k).
double(p).
double(b).
double(t).
double(r).
double(s).

% translation tables
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

% dakuten rules
trans([j,i], [shi,daku]).
trans([b,u], [fu,daku]).
trans([z,u], [tsu,daku]).
trans([g,V], [X,daku]) :- trans([k,V], X).
trans([z,V], [X,daku]) :- trans([s,V], X).
trans([d,V], [X,daku]) :- trans([t,V], X).
trans([b,V], [X,daku]) :- trans([h,V], X).

% handakuten rules
trans([p,u], [fu,handa]).
trans([p,V], [X,handa]) :- trans([h,V], X).

% clauses for solving
solve([],[]).
solve([C|[V|T]], [H|S]) :- trans([C,V], H) , solve(T, S).
% manages the small tsu for double letters
solve([C|[C|[V|T]]], [[tsu,small]|[H|S]]) :- double(C), trans([C,V], H) , solve(T, S).

% manages ja ju jo
solve([j|[V|T]], [[shi,daku]|[[Y,small]|S]]) :- vowel(V) , trans([y, V], Y) , solve(T, S).
% manages kyo kyu jyu nya myo gyu
solve([C|[y|[V|T]]], [K|[[Y,small]|S]]) :- trans([C,i], K) , trans([y, V], Y) , solve(T, S).
% manages shi chi tsu
solve([C1|[C2|[V|T]]], [H|S]) :- trans([C1,C2,V], H) , solve(T, S).
% manages sha sho shu cho
solve([C|[h|[V|T]]], [H|[[Y,small]|S]]) :- trans([C,h,i], H) , trans([y, V], Y) , solve(T, S).

% manages one letter vowel
solve([V|T],[V|S]) :- vowel(V) , solve(T, S).
% eliminates n followed by a vowel
solve([n|[V|X]],Z) :- vowel(V) , ! , fail.
% manages n
solve([n|T],[n|S]) :- solve(T, S).
